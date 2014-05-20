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
        $listeners = $this->getListenersByName($key);
        $index = $listeners->linearSearch($listener);
        if ($index > -1) {
            $listeners->removeKey($index);
        }
    }

    public function trigger(string $key, ...): void
    {
        $listeners = $this->getListenersByName($key);
        foreach ($listeners as $listener) {
            $callable = $listener;
            $args = func_get_args();
            if (count($args) > 1) {
                $callable = () ==> call_user_func_array($listener, array_slice($args, 1));
            }
            $callable();
        }
    }

    public function getListeners(): array<string, Vector<(function(...): void)>>
    {
        return $this->listeners;
    }

    public function getListenersByName(string $name): Vector<(function(...): void)>
    {
        if (array_key_exists($name, $this->listeners)) {
            return $this->listeners[$name];
        }
        throw new EventNotFoundException("Event with name $name not found");
    }

    public function removeListeners(?string $event = null): void
    {
        if (!is_null($event) && array_key_exists($event, $this->listeners)) {
            //no support for unset?
            $copy = [];
            foreach ($this->listeners as $key => $collection) {
                if ($key != $event) {
                    $copy[$key] = $collection;
                }
            }
            $this->listeners = $copy;
            return;
        }
        $this->listeners = [];
    }
}
