<?php
use app\models\TblAppProgram;
use app\models\TblProgramType;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Program Selection';
$this->params['breadcrumbs'][] = $this->title;
$programTypes = TblProgramType::find()->all();
$selectedCourses = TblAppProgram::find()->where(['osn_id' => Yii::$app->session->get('osn')])->all();

$this->registerCss(<<<CSS

    
    .program-selector {
        margin-bottom: 30px;
    }
    
    .program-category-select {
        border: 2px solid var(--primary-color);
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s;
        background-color: white;
    }
    
    .program-category-select:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }
    
    .selected-programs {
        background: var(--light-gray);
        border-radius: 8px;
        padding: 25px;
        margin-top: 30px;
        border: 1px solid var(--border-color);
    }
    
    .selected-programs h5 {
        color: var(--secondary-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
    }
    
    .program-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .program-table thead th {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 15px;
        text-align: left;
    }
    
    .program-table tbody tr {
        transition: all 0.2s;
    }
    
    .program-table tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }
    
    .program-table td {
        padding: 12px 15px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }
    
    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
    }
    
    .btn-outline-secondary {
        border-color: var(--secondary-color);
        color: var(--secondary-color);
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--secondary-color);
        color: white;
    }
    
    /* Modal Styling */
    .program-modal .modal-content {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .program-modal .modal-header {
        background: linear-gradient(135deg, var(--secondary-color), #1a252f);
        color: white;
        border-bottom: none;
    }
    
    .program-modal .modal-body {
        padding: 0;
    }
    
    .program-modal .table {
        margin-bottom: 0;
    }
    
    .program-modal .table th {
        background-color: var(--light-gray);
        color: var(--secondary-color);
    }
    
    .program-modal .table tr:last-child td {
        border-bottom: none;
    }
    
    .program-modal .modal-footer {
        background-color: var(--light-gray);
        border-top: none;
    }
    
    /* Custom radio button */
    .program-radio {
        position: relative;
        width: 20px;
        height: 20px;
        margin: 0 auto;
    }
    
    .program-radio input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    
    .program-radio .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: white;
        border: 2px solid var(--primary-color);
        border-radius: 50%;
    }
    
    .program-radio input:checked ~ .checkmark {
        background-color: var(--primary-color);
    }
    
    .program-radio .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    
    .program-radio input:checked ~ .checkmark:after {
        display: block;
    }
    
    .program-radio .checkmark:after {
        top: 4px;
        left: 4px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }
    
    @media (max-width: 768px) {
        .program-selection-container {
            margin: 15px;
        }
        
        .selection-body {
            padding: 20px;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 10px;
        }
        
        .action-buttons .btn {
            width: 100%;
        }
    }
CSS);
?>

<div class="program-selection-container">
    <div class="selection-header">
        <h3>Program Selection</h3>
        <p>Choose your desired program of study</p>
    </div>
    
    <div class="selection-body">
        <div class="program-selector">
            <?php $form = ActiveForm::begin([
                'action' => Yii::$app->urlManager->createUrl(['program']),
                'options' => ['class' => 'program-selection-form']
            ]); ?>
            
            <div class="form-group mb-4">
                <label for="programme-category" class="form-label fw-semibold mb-2">Program Category</label>
                <select name="programme-category" id="programme-category" class="form-select program-category-select">
                    <option value="" disabled selected>-- Select Program Category --</option>
                    <?php foreach ($programTypes as $item): ?>
                        <option value="<?= $item->id ?>"><?= $item->name ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="text-muted mt-1 d-block">Select a category to view available programs</small>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
        
        <?php if ($selectedCourses): ?>
            <div class="selected-programs">
                <h5>Your Selected Program(s)</h5>
                
                <div class="table-responsive">
                    <table class="program-table">
                        <thead>
                            <tr>
                                <th>Program Code</th>
                                <th>Program Name</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($selectedCourses as $item): ?>
                                <tr>
                                    <td><?= $item->program->program_code ?? '' ?></td>
                                    <td><?= $item->program->program_name ?? '' ?></td>
                                    <td><?= $item->program->level->level_name ?? '' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="action-buttons">
                    <?= Html::a('<i class="fas fa-arrow-left me-2"></i> Back', ['application'], ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::a('Next <i class="fas fa-arrow-right ms-2"></i>', ['site/education'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    var programme = document.getElementById('programme-category');
    programme.addEventListener('change', function() {
        $("#modelId").modal("show");
        $.ajax({
            async: true, 
            type: 'POST',
            url: '<?= Yii::$app->urlManager->createUrl('site/programs')?>/' + '&id=' + programme.value,
            data: programme.value,
            dataType: 'json',
            cache: false,
            success: function(data) {
                no = 1;
                $('#programmes').empty();
                $.each(data, function(index, itemData) {
                    $('#programmes').append( 
                    "<tr>" +
                    "<td>" + (no++) + "</td>" +
                    "<td>" + (itemData.programme ?? '') + "</td>" +
                    "<td>" + (itemData.code ?? '') + "</td>" +
                    "<td>" + (itemData.level ?? '') + "</td>" +
                    "<td><label class='program-radio'><input type='radio' value='" + itemData.id + "' name='program'><span class='checkmark'></span></label></td>" +
                    "</tr>"
                    );
                    $('#programme-title').text(itemData.category);
                });
            },
            error: function(data) { 
                console.error("Error loading programs");
            },
        });
    });
</script>

<!-- Program Selection Modal -->
<div class="modal fade program-modal" data-bs-backdrop="static" id="modelId" tabindex="-1" aria-labelledby="programmeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <?php $form = ActiveForm::begin([
            'action' => Yii::$app->urlManager->createUrl(['site/courses']),
            'options' => ['class' => 'w-100']
        ]); ?>

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center" id="programmeModalLabel">
                    <i class="fas fa-graduation-cap me-2"></i> 
                    <span id="programme-title"></span> Programs
                </h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Program</th>
                                <th scope="col">Code</th>
                                <th scope="col">Level</th>
                                <th scope="col" class="text-center">Select</th>
                            </tr>
                        </thead>
                        <tbody id="programmes">
                            <!-- AJAX Injected Rows -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cancel
                </button>
                <?= Html::submitButton('<i class="fas fa-check me-2"></i> Confirm Selection', [
                    'class' => 'btn btn-primary'
                ]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>