<?hh //strict
namespace HackPack\Hacktions;

trait EventEmitter
{
    protected Vector<(function(...): void)> $listeners = Vector {};

    public function on(string $key, (function(...): void) $listener): void
    {
        $this->listeners->add($listener);
    }

    public function off(string $key, (function(...): void) $listener): void
    {
        $index = $this->listeners->linearSearch($listener);
        if ($index > -1) {
            $this->listeners->removeKey($index);
        }
    }

    public function getListeners(): Vector<(function(...): void)>
    {
        return $this->listeners;
    }
}
