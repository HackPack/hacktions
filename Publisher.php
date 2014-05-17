<?hh //strict
namespace HackPack\Hacktions;

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

interface ListenerCollection 
{
    public function add<T>((function(T): void) $listener): ListenerCollection;

    public function all<T>(): Vector<(function(T): void)>;
}

class TypedListenerCollection<T> implements ListenerCollection
{
    protected Vector<(function(T): void)> $listeners = Vector {};

    public function __construct()
    {

    }

    public function add((function(T): void) $listener): TypedListenerCollection<T>
    {
        $this->listeners->add($listener);
        return $this;
    }

    public function all(): Vector<(function(T): void)>
    {
        return $this->listeners;
    }
}
