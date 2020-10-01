<?php

declare(strict_types=1);

namespace App\Controller\Review_items;

use App\Helper\JsonResponse;
use App\Helper\FileUpload;
use App\Helper\InputUpdate;
use Psr\Http\Message\UplaodedFileInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {

        $input = $request->getParsedBody();
        $file_uploaded = $request->getUploadedFiles();
    
        $input['images'] = FileUpload::getFileUrl($file_uploaded);
        $input = InputUpdate::addMissingDefault($input);
       // var_dump($file_uploaded);
       // var_dump($input); die();
        $review_items = $this->getReview_itemsService()->create($input);

        //print_r($review_items);die();

        if(!empty($review_items) && $review_items->id > 0)  {
            $review_data = Array(
                'review_comment' => $input['review_comment'],
                'review_rate' => $input['review_rate'],
                'review_items_id' => $review_items->id,
                'review_app_user_id' => $review_items->review_app_user_id,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            );
            //print_r($review_data);die();
            $review_items->reviews = $this->getReviewsService()->create($review_data);
            $review_items->no_of_reviews = 1;
            $review_items->avg_rating = $input['review_rate'];
        }

        return JsonResponse::withJson($response, json_encode($review_items), 201);
    }
}
