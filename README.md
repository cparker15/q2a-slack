# q2a-slack

Send alerts from [Question2Answer] to a [Slack] channel. Currently supported events:

  - `q_post` *new question posted*
  - `a_post` *new answer posted*
  - `c_post` *new comment posted*
  - `q_edit` *question edited*
  - `a_edit` *answer edited*
  - `c_edit` *comment edited*
  - `a_select` *answer selected*

## Installation

Simply place the `q2a-slack` folder into the `qa-plugin` folder, then change the three configuration variables in `qa-plugin/q2a-slack/qa-slack.php`.

*Note:* [Some people](http://www.question2answer.org/qa/46608/are-there-any-plug-that-will-post-questions-and-answers-slack) have reported they need to set `CURLOPT_SSL_VERIFYPEER` to `false` for this to work. Uncomment out [the correct line](https://github.com/LeonardChallis/q2a-slack/blob/master/q2a-slack/qa-slack.php#L65-L67) in `qa-slack.php` to make this work.

## Contact

Want something adding? Add it yourself, or send me a note and I'll pop it in :) Find me on [@LeonardChallis] posting pictures of my boys and my dinner.

[Question2Answer]:http://www.question2answer.org/
[Slack]:https://slack.com/
[@LeonardChallis]:https://twitter.com/leonardchallis

