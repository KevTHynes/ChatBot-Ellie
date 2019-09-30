<?php
session_start();
require 'config.php';
require_once 'vendor\autoload.php';
$pos = new \StanfordTagger\POSTagger();

$input = $_POST['text'];

if (isset($_SESSION['lastQ'])) {
    if ($_SESSION['lastQ'] == $input) {
        print "Don't repeat yourself";
        exit;
    }
}

$_SESSION['lastQ'] = $input;
date_default_timezone_set('GMT');

// static responses
if ($input == "What day is it?") {
    print "Today is " . date("l");
    exit;
}
else if (strpos($input, 'day') !== false) {
    print "I presume that you would like to know what day it is...ask properly";
    exit;
}
else if ($input == "What time is it?") {
    print "Dont be lazy, Check the clock maybe?";
    exit;
}
else if ($input == "what time is it?") {
    print "Dont be lazy, Check the clock maybe?";
    exit;
}
else if (stripos($input, 'hello') !== false) {
    print "Hello :)";
    exit;
}
else{

    // this is were we check the database for similar questions and answers...
    $q1 = "SELECT `response` FROM `interactions` WHERE `query` = '$input'";
    $result = $conn->query($q1);

    //checking the DB for the response
    if($result->rowCount() > 0){
        while ($row = $result->fetch()) {
            print "{$row[0]} {$row[1]}";
        }
    }
    else{//If response is not in DB then search google for a response!!!

        $stringInput = str_replace(' ', '+', $input);
        $url = "https://www.googleapis.com/customsearch/v1?q='$stringInput'&cx=015225800438708463049%3Aomuwtbrblj8&key=AIzaSyDKeWyCBxFPIPAKBzy5wWxhXUctMPx5HS0";
        $search = file_get_contents($url);
        $array = json_decode($search, true);

        $q1 = 'who';
        $q2 = 'when';
        $answer = '';

        $success = false;

        foreach($array['items'] as $snippet){//Looping through search results
            if($success == true){//if we get our hit, stop this loop
                break;
            }

            $output = ($snippet['snippet']);

            $regexp = '/[.,?!]/';//Our regular expression
            $arr = preg_split($regexp, $output);//Break sentences into array after expressions

            foreach($arr as $str){//Looping through each broken sentence

                if($success == true){//if we get our hit, stop this loop
                    break;
                }

                if(stripos($input, $q1) !== false){//The Who question

                    try{
                        $testOut = $pos->tag($str);//POSTagger the sentence

                        $tagArr = explode(" ",$testOut);//Separate white space from strings

                        foreach($tagArr as $value){//loop through the tagged strings

                            if($success == true){//if we get our hit, stop this loop
                                break;
                            }

                            $posTag = explode("_",$value);//separates "_" from the tagged strings

                            if($posTag[1]=="NNP"){//Identifying the nouns for parsing

                                $answer = $answer." ".$posTag[0];

                            }

                        }//End inner loop for tagging the Nouns

                        $success = true;//call all flags because we have found our result
                    }
                    catch (Exception $e){
                        $e = ($success = false);
                    }

                }//End if statement for asking the "Who" question

                else if(stripos($input, $q2) !== false){//The When question

                    try{
                        $testOut = $pos->tag($str);//POSTagger the sentence
                        $tagArr = explode(" ",$testOut);//Separate white space from strings

                        foreach($tagArr as $value){//loop through the tagged strings

                            if($success == true){//if we get our hit, stop this loop
                                break;
                            }

                            $posTag = explode("_",$value);//separates "_" from the tagged strings

                            if($posTag[1]=="CD"){//Identifying the numbers for parsing

                                if (preg_match('/(?:(?:19|20)[0-9]{2})/', $posTag[0], $tempAr)){//We only check for numbers from 1900 - 2099
                                    $tempAr = $answer;//the answer we found stored in the separate array and set it as the answer
                                    $answer = $answer." ".$posTag[0];
                                    $success = true;//call all flags because we have found our result
                                    break;
                                }
                                else{
                                    continue;
                                }//end if statement for matching regex number parsing

                            }//end if statment for number parsing

                        }//end inner loop for tagged numbers
                    }
                    catch (Exception $e){
                        $e = ($success = false);
                    }

                }//end if statement for asking the "When" question

            }//end inner loop for sentence breaking

        }//end outer loop for iterating through search results (JSON format)
        if($answer == ''){
            print 'I do not know everything, Please ask me something else!';
        }
        else{
            print $answer;
        }
    }//end else clause
}
?>