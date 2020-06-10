<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\News;
use App\Keyword;

class SearcherService
{   
    private function getSearch()
    {   
        $keywords = Keyword::all();

        $news = array();
        foreach($keywords as $keyword){
            
            $response = Http::get('https://newsapi.org/v2/everything?q=' . $keyword->name . '&language=pt&from=' . Carbon::now()->subDays(2)->startOfDay()->format('Y-m-d') . '&apiKey=' . env('NEWS_API_TOKEN'));

            $data = json_decode($response->getBody(), true);

            array_push($news, $data);
        
        }
        
        $cleanedNews = $this->handleResponse($news);
        
        return $cleanedNews;
    }


    public function getData()
    {
        $data = $this->getSearch();

        return $data;
    }

    public function formatToMessage($article)
    {   

        $text =
            "Site: " . $article["source"] . "\n" .
            "Título: " . $article["title"] . "\n" .
            "Descrição: " . $article["description"] . "\n" .
            "Link: " . $article["url"] . " - " . " Postada em: " . Carbon::parse($article["published_at"])->format('d/m/Y H:m')
        ;

        return $text;
    }

    private function handleResponse($news)
    {
        $articles = array();

        foreach($news as $i => $value){
            foreach($news[$i]["articles"] as $article){

                $newsExists = News::where('title', $article["title"])
                                  ->where('source', $article["source"]["name"])
                                  ->first();

                if($newsExists){

                    // If news already exists on database, but marked was not sent
                    if(empty($newsExists->sent_at)){

                        $data = $this->getNewsArray($newsExists, true);
                         
                        // Push into the articles array
                        array_push($articles, $data);

                    }            

                } else {
                    
                    //If news not exists on database
                    $data = $this->getNewsArray($article, false);

                    //Create the news on database
                    News::create($data);

                    // Push into the articles array
                    array_push($articles, $data);

                }
            }
        }

        return $articles;
    }

    private function getNewsArray($newsData, $newsExists)
    {
        if($newsExists){

            $data = array(
                'source' => $newsData->source,
                'title' => $newsData->title,
                'description' => $newsData->description,
                'url' => $newsData->url,
                'published_at' => $newsData->published_at
            );
            
        } else {

            $data = array(
                'source' => $newsData["source"]["name"],
                'title' => $newsData["title"],
                'description' => $newsData["description"],
                'url' => $newsData["url"],
                'published_at' => Carbon::parse($newsData["publishedAt"])
            );

        }

        return $data;
    }
    
    public function markMessageAsSent($message)
    {
        $news = News::where('title', $message["title"])
                    ->where('source', $message["source"])
                    ->first();

        $news->update([
            'sent_at' => Carbon::now()
        ]);

        return true;
    }
}
