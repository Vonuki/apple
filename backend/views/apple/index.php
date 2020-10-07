<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Apple;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Generate Apples', ['generate'], ['class' => 'btn btn-warning']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'idApple',
            [
                'attribute' => 'Color',
                 'format' => 'raw',
                'value' => function ($model, $key, $index, $widget) { 
                    return "<b style='color:".$model->Color."'>".$model->Color."</b>";
                },
            ],
            'CreateDate',
            'FallDate',
            [   
                'attribute' => 'State',
                'value' => function ($model, $key, $index, $widget) { 
                    return $model->StateName;
                },
            ],
            [   
                'attribute' => 'Eaten',
                'label' => 'Apple Size (%)',
                'value' => function ($model, $key, $index, $widget) { 
                    return $model->Size;
                },
            ],
            [ 'class' => 'yii\grid\ActionColumn',
              'template' => '{update} {delete} {fall} {eat}',
              'buttons' => [
                  'eat' => function ($url, $model,$key){
                      return '<a onclick="changeIdText('.$model->idApple.')" title="Eat" href="" data-toggle="modal" data-target="#exampleModal">  <span class="glyphicon glyphicon-cutlery"></span> </a>';
                   },
                  'fall' => function ($url, $model,$key) {
                       return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', $url, ['title' => 'Fall']);
                  },
                ],
            ],     
        ],
    ]); ?>
  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eat some Apple
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </h5>
        </div>
        <?php
          $form = ActiveForm::begin([
            'options' => ['id'=>'eat-form'],
            'method' => 'get',
            'action' => ['apple/eat'],
          ]);
        ?>
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value = "0" >
          What part to eat (%)  = <input type='text' name="eat_part">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?=Html::submitButton('Submit', ['class' => 'btn btn-primary'])?>
        </div>
        <?php
           ActiveForm::end();
        ?>
      </div>
    </div>
  </div>

</div>

<script>

   function changeIdText(value) {
     document.getElementById('id').value = value;   
  }
  
</script>
