<?php

namespace App\DependencyInjection\Compiler;

use ElyAccount\Handler\HandlesCommand;
use ReflectionClass;
use RuntimeException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Compiler pass used to configure the domain command handlers.
 * Symfony MessageBus needs handlers with a specific configuration in order
 * to be able to auto-configure message handlers.
 * The handlers from my domain wasn't compliant to this configuration.
 * So I use this compiler pass to configure all my handlers with the correct tags.
 *
 * This compiler pass needs to be called before the MessengerPass !
 *
 * @see CompilerPassInterface
 */
final class DomainHandlersPass implements CompilerPassInterface
{
    private const BUS_ATTRIBUTE = 'bus';

    /**
     * @var string
     */
    private $domainHandlerTag;

    /**
     * @var string
     */
    private $messengerHandlerTag;

    /**
     * @var string
     */
    private $messengerBusId;


    /**
     * Initializes the compiler pass
     *
     * @param string $domainHandlerTag
     * @param string $messengerHandlerTag
     * @param string $messengerBusId
     */
    public function __construct(
        string $domainHandlerTag = 'domain.command_handler',
        string $messengerHandlerTag = 'messenger.message_handler',
        string $messengerBusId = 'messenger.bus.commands'
    ) {
        $this->domainHandlerTag    = $domainHandlerTag;
        $this->messengerHandlerTag = $messengerHandlerTag;
        $this->messengerBusId      = $messengerBusId;
    }

    /**
     * {@inheritDoc}
     *
     * @throws RuntimeException
     */
    public function process(ContainerBuilder $container)
    {
        foreach ($container->findTaggedServiceIds($this->domainHandlerTag) as $serviceId => $tags) {
            $definition      = $container->getDefinition($serviceId);
            $className       = $definition->getClass();
            $reflectionClass = $container->getReflectionClass($className);

            self::assertHandlerType($reflectionClass, $serviceId, $className);

            foreach ($tags as $attributes) {
                $messengerBusId = $attributes[self::BUS_ATTRIBUTE] ?? $this->messengerBusId;

                self::assertThatABusServiceExists(
                    $container,
                    $messengerBusId,
                    $this->domainHandlerTag,
                    $className
                );

                $definition->addTag($this->messengerHandlerTag, [
                    'handles' => $className::getCommandHandledType(),
                    'method'  => 'handle',
                    'bus'     => $messengerBusId,
                ]);
            }
        }
    }

    /**
     * Asserts that a class is indeed one of my domain command handler
     *
     * @param ReflectionClass $reflectionClass
     * @param string $serviceId
     * @param string $className
     *
     * @return void
     */
    private static function assertHandlerType(
        ReflectionClass $reflectionClass,
        string $serviceId,
        string $className
    ) {
        if (!$reflectionClass->implementsInterface(HandlesCommand::class)) {
            throw new RuntimeException(sprintf(
                'Invalid service "%s": class "%s" does not match the expected type "%s".',
                $serviceId,
                $className,
                HandlesCommand::class
            ));
        }
    }

    /**
     * Asserts that a given busId exists.
     *
     * @param ContainerBuilder $container
     * @param string $messengerBusId
     * @param string $tagName
     * @param string $className
     *
     * @return void
     *
     * @throws RuntimeException
     */
    private static function assertThatABusServiceExists(
        ContainerBuilder $container,
        string $messengerBusId,
        string $tagName,
        string $className
    ) {
        if (!$container->has($messengerBusId)) {
            throw new RuntimeException(sprintf(
                'The service tag "%s" defined as "%s" attribute to the tag "%s"'
                . ' for the class "%s" does not exists',
                $messengerBusId,
                self::BUS_ATTRIBUTE,
                $tagName,
                $className
            ));
        }
    }
}
