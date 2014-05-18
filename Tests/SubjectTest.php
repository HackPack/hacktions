<?hh //strict
namespace HackPack\Hacktions\Tests;

use HackPack\HackUnit\Core\TestCase;
use HackPack\Hacktions\Subject;

class SubjectTest extends TestCase
{
    public function test_notify_notifies_observers(): void
    {
        $subject = new TestSubject();
        $observer = new TestObserver();
        $subject->registerObserver($observer);

        $subject->notifyObservers();

        $this->expect($observer->getNotificationCount())->toEqual(1);
    }
}
