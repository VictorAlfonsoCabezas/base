<?php

namespace Tests\Unit;

use App\Http\Controllers\HomeController;
use App\Models\Company;
use App\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\TestCase;

class RemovedModulesTest extends TestCase
{
    private $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = require __DIR__ . '/../../bootstrap/app.php';
        $this->app->make(Kernel::class)->bootstrap();
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    public function testRemovedModulesHaveNoRegisteredRoutes(): void
    {
        $removed = [
            'envios', 'planes', 'suscription', 'typeaffiliation', 'affiliation',
            'procedures', 'doctor', 'sede', 'departament', 'atention', 'bot',
            'chatbot', 'apiheader', 'intention', 'pagos', 'massive', 'agent',
            'categorychat', 'webhooks', 'webhookstwilio', 'webhookskushki',
            'webhookorion', 'home/graficaAgente', 'home/graficaAgenteSupervisor',
            'home/contarMensajes', 'home/drawGraph', 'company/updateSede',
            'company/knowInstance', 'company/showCompanies',
        ];

        foreach ($this->app['router']->getRoutes() as $route) {
            foreach ($removed as $prefix) {
                $this->assertFalse(
                    $route->uri() === $prefix || strpos($route->uri(), $prefix . '/') === 0,
                    'Unexpected route: ' . $route->uri()
                );
            }
        }

        $this->assertTrue($this->app['router']->has('home'));
        $this->assertTrue($this->app['router']->has('company.index'));
        $this->assertTrue($this->app['router']->has('customer.index'));
    }

    public function testHomeUsesGeneralViewWithoutChatOrRoleQueries(): void
    {
        $company = new Company(['company_name' => 'Empresa']);
        $user = new User();
        $user->setRelation('company', $company);
        Auth::shouldReceive('user')->once()->andReturn($user);

        $view = (new HomeController())->index();

        $this->assertSame('home.default', $view->name());
        $this->assertSame($company, $view->getData()['company']);
        $this->assertSame($user, $view->getData()['user']);
    }
}
