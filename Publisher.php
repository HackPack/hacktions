<?hh //strict
namespace HackPack\Hacktions;

use HackPack\Hacktions\Collection\ListenerCollection;
use HackPack\Hacktions\Collection\TypedListenerCollection;

trait Publisher
{
    protected array<string, ListenerCollection> $listeners = [];

    public function trigger<T>(string $eventName, T $arg): void
    {
        if (! array_key_exists($eventName, $this->listeners)) {
            return;
        }
        $listeners = $this->listeners[$eventName];
        foreach ($listeners->all() as $listener) {
            $listener($arg);
        }
    }

    public function on<T>(string $eventName, (function(T): void) $listener): void
    {
        if (! array_key_exists($eventName, $this->listeners)) {
            $this->listeners[$eventName] = new TypedListenerCollection();
        }
        $this->listeners[$eventName]->add($listener);
    }
}



