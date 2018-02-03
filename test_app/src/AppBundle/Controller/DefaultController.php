<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
    * @Route("/test", name="test")
    */
    public function testAction(Request $request)
    {
      if ($request->getMethod() == "POST" ) {
        $logger = $this->get("logger");
        $client = $request->headers->get("X-Forwarded-For",$request->getClientIp());
        $page = "/test";
        $msg = $request->get("msg");
        $context = array("client" => $client, "page" => $page);
        $logger->info($msg, $context);
        return new Response(
          "<html><body>Logged message " . $msg . ", view it on kibana</body></html>"
        );
      }
      return $this->render("test.html.twig");
    }
}
