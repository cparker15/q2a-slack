<?php
/*
        q2a-slack by Leonard Challis
        http://www.leonardchallis.com/

        for
            
        Question2Answer by Gideon Greenspan and contributors
        http://www.question2answer.org/

        File: qa-plugin/slack/qa-plugin.php
        Description: Posts information to Slack
 */
class qa_slack
{

    // change these three lines
    private $siteUrl = 'http://your-q2a-site.com/';
    private $slackUrl = 'https://hooks.slack.com/services/ABCDEFGHI/ABCDEFGHI/ABCdef123456GHIjkl7890';
    private $linkMessage = 'View on Q2A Site!';

    public function process_event($event, $userid, $handle, $cookieid, $params)
    {
        $eventDescription = null;

        switch ($event) {
            case 'q_post':
                $eventDescription = 'asked a question `' . $params['title'] . "`\n<" . $this->siteUrl . $params['postid'] . "|" . $this->linkMessage . ">";
                break;
            case 'a_post':
                $eventDescription = 'answered ' . ($params['parent']['handle'] == $handle ? 'their own' : $params['parent']['handle'] . "'s") . " question `" . $params['parent']['title'] . "`\n<" . $this->siteUrl . $params['parent']['postid'] . "|" . $this->linkMessage . ">";
                break;
            case 'c_post':
                $type = ($params['parenttype'] == 'A') ? 'answer for question' : $type = 'question';
                $eventDescription = 'commented on ' . ($params['parent']['handle'] == $handle ? 'their own' : $params['parent']['handle'] . "'s") . " $type `" . $params['question']['title'] . "`\n<" . $this->siteUrl . $params['questionid'] . "|" . $this->linkMessage . ">";
                break;
            case 'q_edit':
                $eventDescription = 'edited ' . ($params['oldquestion']['handle'] == $handle ? 'their own' : $params['oldquestion']['handle'] . "'s") . " question `" . $params['title'] . "`\n<" . $this->siteUrl . $params['oldquestion']['postid'] . "|" . $this->linkMessage . ">";
                break;
            case 'a_edit':
                $eventDescription = 'edited ' . ($params['oldanswer']['handle'] == $handle ? 'their own' : $params['oldanswer']['handle'] . "'s") . " answer for `" . $params['parent']['title'] . "`\n<" . $this->siteUrl . $params['parent']['postid'] . "|" . $this->linkMessage . ">";
                break;
            case 'c_edit':
                $type = ($params['parenttype'] == 'A') ? 'answer for question' : $type = 'question';
                $eventDescription = 'edited ' . ($params['oldcomment']['handle'] == $handle ? 'their own' : $params['oldcomment']['handle'] . "'s") . ' comment on ' . ($params['parent']['handle'] == $handle ? 'their own' : $params['parent']['handle'] . "'s") . " $type `" . $params['question']['title'] . "`\n<" . $this->siteUrl . $params['questionid'] . "|" . $this->linkMessage . ">";
                break;
            case 'a_select':
                $eventDescription = 'selected ' . ($params['answer']['handle'] == $handle ? 'their own' : $params['answer']['handle'] . "'s") . " answer for " . ($params['parent']['handle'] == $handle ? 'their own' : $params['parent']['handle'] . "'s") . " question `" . $params['parent']['title'] . "`\n<" . $this->siteUrl . $params['parent']['postid'] . "|" . $this->linkMessage . ">";
                break;
        }

        if (null === $eventDescription) {
            return;
        }

        $message = "$handle has just $eventDescription";

        $data = array('text' => $message, 'icon_emoji' => ':question:', 'username' => 'ombrelle-ask');
        $data_string = json_encode($data);

        $ch = curl_init($this->slackUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));

        $result = curl_exec($ch);
    }
}

