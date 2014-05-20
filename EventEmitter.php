<?hh //strict
namespace HackPack\Hacktions;

trait EventEmitter
{
    protected array<string, Vector<(function(...): void)>> $listeners = [];

    public function on(string $key, (function(...): void) $listener): void
    {
        if (! array_key_exists($key, $this->listeners)) {
            $this->listeners[$key] = Vector {};
        }
        $this->listeners[$key]->add($listener);
    }

    public function off(string $key, (function(...): void) $listener): void
    {
        $listeners = $this->listeners[$key];
        $index = $listeners->linearSearch($listener);
        if ($index > -1) {
            $listeners->removeKey($index);
        }
    }

    public function trigger(string $key): void
    {
        $listeners = $this->listeners[$key];
        foreach ($listeners as $listener) {
            $listener();
        }
    }

    public function getListeners(): array<string, Vector<(function(...): void)>>
    {
        return $this->listeners;
    }
}
