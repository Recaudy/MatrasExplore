<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');

        // Track Unique Visitor per Day
        $this->trackVisitor($request);
    }

    private function trackVisitor(RequestInterface $request)
    {
        // Don't track if this is a CLI request or a bot (basic check)
        if (is_cli()) return;

        $ipAddress = $request->getIPAddress();
        $today = date('Y-m-d');

        $visitorModel = new \App\Models\VisitorModel();
        $existing = $visitorModel->where('ip_address', $ipAddress)
                                 ->where('visit_date', $today)
                                 ->first();
        if (!$existing) {
            $visitorModel->insert([
                'ip_address' => $ipAddress,
                'visit_date' => $today
            ]);
        }
    }
}
