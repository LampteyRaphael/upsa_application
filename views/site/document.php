<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Document Upload';
$this->registerCss(<<<CSS
    .document-upload-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .upload-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .upload-header h1 {
        color: #2c3e50;
        font-weight: 600;
    }
    .upload-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        border-left: 4px solid #3498db;
    }
    .upload-form-row {
        display: flex;
        align-items: flex-end;
        gap: 15px;
    }
    .form-group {
        margin-bottom: 0;
        flex: 1;
    }
    .document-table {
        margin-top: 30px;
    }
    .document-table th {
        background-color: #2c3e50;
        color: white;
    }
    .action-buttons {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    .btn-upload {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 8px 20px;
    }
    .btn-upload:hover {
        background-color: #2980b9;
    }
    .file-input-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .custom-file-btn {
        padding: 8px 15px;
        background: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 4px;
        cursor: pointer;
        white-space: nowrap;
    }
    .file-selected {
        font-size: 14px;
        color: #6c757d;
        flex-grow: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    @media (max-width: 768px) {
        .upload-form-row {
            flex-direction: column;
            align-items: stretch;
        }
        .file-input-container {
            flex-direction: column;
            align-items: stretch;
        }
    }

    .action-buttons {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        padding: 10px 25px;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }
    .btn-outline-secondary {
        padding: 10px 25px;
        font-weight: 500;
    }
    @media (max-width: 768px) {
        .education-form-container {
            padding: 20px;
        }
        .col-md-4 {
            margin-bottom: 15px;
        }
    }

    
CSS);
?>
    <div class="program-selection-container">
    <div class="selection-header">
        <h3>Document Upload</h3>
        <p>Please upload all required documents for your application</p>
    </div>

    <!-- Upload Card -->
    <div class="upload-card">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'class' => 'upload-form'], 
            'action' => Yii::$app->urlManager->createUrl(['/site/document'])
        ]); ?>
        
        <div class="upload-form-row">
            <div class="form-group">
                <?= $form->field($model, 'category')->dropDownList([
                    '' => 'Select Document Type',
                    'Academic_Certificate' => 'Academic Certificate',
                    'Birth_Certificate' => 'Birth Certificate',
                    'National_Identification' => 'National Identification',
                    'Other_Document' => 'Other Document'
                ], [
                    'id' => 'category',
                    'class' => 'form-control'
                ])->label('Document Type') ?>
            </div>
            
            <div class="form-group">
                <div class="file-input-container">
                    <label for="docfile" class="custom-file-btn">
                        <i class="fas fa-folder-open"></i> Choose File
                    </label>
                    <div id="file-selected" class="file-selected">No file selected</div>
                    <?= $form->field($model, 'doc_name')->fileInput([
                        'id' => 'docfile',
                        'class' => 'form-control-file d-none'
                    ])->label(false) ?>
                </div>
            </div>
            
            <div class="form-group">
                <?= Html::submitButton('<i class="fas fa-upload"></i> Upload', [
                    'class' => 'btn btn-upload btn-block'
                ]) ?>
            </div>
        </div>
        
        <input type="hidden" name="category_name" id="main" value="">
        <?php ActiveForm::end(); ?>
    </div>

    <!-- Uploaded Documents Table -->
    <?php if($doc): ?>
    <div class="document-table">
        <h4>Uploaded Documents</h4>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Document Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($doc as $i => $item): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= Html::encode($item->category ?? '') ?></td>
                        <td>
                            <div class="btn-group">
                                <!-- <= Html::a('<i class="fas fa-eye"></i> View', ['view', 'id' => $item->id], [
                                    'class' => 'btn btn-sm btn-outline-primary',
                                    'target' => '_blank'
                                ]) ?> -->
                                <?= Html::a('<i class="fas fa-trash"></i> Delete', ['delete', 'id' => $item->id], [
                                    'class' => 'btn btn-sm btn-outline-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this document?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-info">No documents uploaded yet.</div>
    <?php endif; ?>

    <!-- Navigation Buttons -->
    <div class="action-buttons d-flex justify-content-between">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Back', ['employment'], [
            'class' => 'btn btn-outline-secondary',
            'data-method' => 'post'
        ]) ?>
        
        <?= Html::a('Next <i class="fas fa-arrow-right"></i>', ['declaration'], [
            'class' => 'btn btn-primary'
        ]) ?>
    </div>
</div>

<?php
$this->registerJs(<<<JS
    // Update hidden field when category changes
    $('#category').on('change', function() {
        const valueMap = {
            'Academic_Certificate': 'Certificate',
            'Birth_Certificate': 'Birth_Certificate',
            'National_Identification': 'National_Identification',
            'Other_Document': 'Other_Document'
        };
        $('#main').val(valueMap[$(this).val()] || '');
    });

    // Show selected filename
    $('#docfile').on('change', function() {
        const fileName = $(this).val().split('\\\\').pop();
        $('#file-selected').text(fileName || 'No file selected');
    });
JS);
?>