<?hh //strict
namespace HackPack\Hacktions\Collection;

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
