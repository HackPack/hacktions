<?hh //strict
namespace HackPack\Hacktions;

trait Subject<T>
{
    protected Vector<T> $observers = Vector {};

    public function registerObserver(T $observer): void
    {
        $this->observers->add($observer);
    }

    public function notifyObservers(): void
    {
        foreach ($this->observers as $observer) {
            invariant($observer instanceof Observer, 'bad');
            $observer->update($this);
        }
    }
}
