<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>CROC Examination!</title>
</head>
<body>
<div class="container">

    <h1><?=$survey->getTitle()?></h1>

    <?php if(!$complete):?>
    <form method="post">
        <?php foreach($survey->getQuestions() as $question):?>
        <div class="q_row">
            <h3 class="mb-12"><?=$question->getText()?></h3>
            <div class="d-block my-3">
                <?php foreach($question->getVariants() as $variant):?>
                <?php $input_id = $question->getID() . '_' . $variant->getID();?>
                <div class="custom-control custom-radio">
                    <input id="q_<?=$input_id?>" name="q_<?=$question->getID()?>" type="radio"
                           class="custom-control-input q_input" value="<?=$variant->getId()?>">
                    <label class="custom-control-label" for="q_<?=$input_id?>"><?=$variant->getText()?></label>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <?php endforeach;?>
        <button class="btn btn-primary btn-next" type="button">Далее</button>
    </form>
    <?php else:?>
    <h3>Результат опроса:</h3>
    <?php foreach($result as $tag => $stat):?>
    <?php $percent = round($stat['answer']/$stat['question']*100,2);?>
    <div class="row">
        <div class="col-md-3"><?=$tag?> (<?=$percent?>%)</div>
        <div class="col-md-9">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?=$percent?>%;"
                     aria-valuenow="<?=$percent?>" aria-valuemin="0" aria-valuemax="100"><?=$percent?>%
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>
</div> <!-- /container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
<script>
    $(function () {
        function next_slide() {
            $('.q_row').hide();
            var index = $('button.btn-next').data('next-index');
            $('.q_row:eq(' + index + ')').show();
            if ($('.q_row').length > index) {
                $('button.btn-next').data('next-index', ++index);
                $('button.btn-next').hide();
            } else {
                $('button.btn-next').hide();
                $('form').submit();
            }
        }

        $('button.btn-next').data('next-index', 0);
        next_slide();
        $('button.btn-next').click(function () {
            next_slide();
        });
        $('.q_input').change(function () {
            $('button.btn-next').show();
        })
    });
</script>
</body>
</html>