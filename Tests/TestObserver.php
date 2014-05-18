<?hh //strict
namespace HackPack\Hacktions\Tests;

use HackPack\Hacktions\Observer;

class TestObserver implements Observer<TestSubject>
{
    protected int $count = 0;

    public function getNotificationCount(): int
    {
        return $this->count;
    }

    public function update(TestSubject $subject): void
    {
        $this->count++;
    }
}
