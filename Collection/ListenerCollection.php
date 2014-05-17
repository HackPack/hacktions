<?hh //strict
namespace HackPack\Hacktions\Collection;

interface ListenerCollection 
{
    public function add<T>((function(T): void) $listener): ListenerCollection;

    public function all<T>(): Vector<(function(T): void)>;
}

