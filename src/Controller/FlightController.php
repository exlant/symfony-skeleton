<?php
declare(strict_types=1);

namespace App\Controller;

use App\Form\SearchFlightType;
use App\Repository\AirTransport\FlightRepository;
use Swagger\Annotations as SWG;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Core\Abstracts\AFormType;

/**
 * Class FlightController
 *
 * @package App\Controller
 *
 * @Route("flight")
 * @SWG\Tag(name="Flight")
 */

final class FlightController extends AController
{
    /**
     * @Route("", methods={"GET"})
     *
     * @SWG\Get(summary="Get flight collection",
     *     @SWG\Response(
     *          response=200,
     *          description="OK"
     *     ),
     *     @SWG\Parameter(
     *          name="filter[departureAirport]",
     *          in="query",
     *          type="string",
     *          required=true,
     *          default="departureAirport"
     *     ),
     *     @SWG\Parameter(
     *          name="filter[arrivalAirport]",
     *          in="query",
     *          type="string",
     *          required=true,
     *          default="arrivalAirport"
     *     ),
     *     @SWG\Parameter(
     *          name="filter[departureDate]",
     *          in="query",
     *          type="string",
     *          format="dateTime",
     *          required=true,
     *          default="departureDate"
     *     ),
     *     @SWG\Parameter(
     *          name="pagination[limit]",
     *          in="query",
     *          type="integer",
     *          required=false,
     *          default="10"
     *     ),
     *     @SWG\Parameter(
     *          name="pagination[page]",
     *          in="query",
     *          type="string",
     *          required=false,
     *          default="1"
     *     ),
     *      @SWG\Parameter(
     *          name="AFormType::ORDER[arrivalDateTime]",
     *          in="query",
     *          type="string",
     *          required=false,
     *          default="DESC",
     *          enum={0:"ASC", 1:"DESC"},
     *          description="Sort by arrival date-time"
     *      ),
     * )
     *
     * @param Request $request
     * @param FlightRepository $flightRepository
     * @return Response
     * @throws \Exception
     */
    public function getCollection(Request $request, FlightRepository $flightRepository): Response
    {
        $requestData = $this->validateFilterRequest(SearchFlightType::class, $request->query->all())->getData();
        $collection = $this->getCollectionByFilters($requestData, $flightRepository);
        
        return $this->response(['ok']);
    
    }
}