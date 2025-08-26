<?php
use kartik\form\ActiveForm;
use yii\bootstrap5\Html;
?>

<style>
    .status-container {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .status-container .status-header {
        padding: 15px;
        flex-grow: 1;
    }
    
    .status-container .status-value {
        font-weight: 600;
        font-size: 1.2rem;
        margin: 5px 0;
    }
    
    .status-container .status-footer {
        padding: 10px 0;
        text-align: center;
        background: rgba(0,0,0,0.1);
        border-top: 1px solid rgba(255,255,255,0.2);
    }
    
    .status-container .status-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 2.5rem;
        opacity: 0.3;
    }
    
    /* Status-specific colors */
    .status-pending { background-color: #6c757d; }
    .status-approved { background-color: #28a745; }
    .status-processing { background-color: #ffc107; color: #212529; }
    .status-rejected { background-color: #dc3545; }
    .status-download { background-color: #17a2b8; }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .status-container .status-icon {
            font-size: 2rem;
        }
    }
</style>

<div class="container">
  <div class="row mt-4 g-4">

    <!-- Application Status -->
    <div class="col-lg-3 col-md-6 col-12">
      <div class="status-container status-<?= strtolower($app ?? 'pending') ?>">
        <div class="status-header">
          <div class="status-value"><?= $app ?? 'Pending' ?></div>
          <small>Application Status</small>
        </div>
        <i class="fas fa-clipboard-list status-icon"></i>
        <div class="status-footer">
          <span class="text-white">
            <i class="fas fa-info-circle"></i> View details
          </span>
        </div>
      </div>
    </div>

    <!-- Qualification Status -->
    <div class="col-lg-3 col-md-6 col-12">
      <div class="status-container status-<?= strtolower($quali ?? 'pending') ?>">
        <div class="status-header">
          <div class="status-value"><?= $quali ?? 'Pending' ?></div>
          <small>Qualification Status</small>
        </div>
        <i class="fas fa-graduation-cap status-icon"></i>
        <div class="status-footer">
          <span class="text-white">
            <i class="fas fa-info-circle"></i> View details
          </span>
        </div>
      </div>
    </div>

    <!-- Admission Status -->
    <div class="col-lg-3 col-md-6 col-12">
      <div class="status-container status-<?= strtolower($admiss ?? 'pending') ?>">
        <div class="status-header">
          <div class="status-value"><?= $admiss ?? 'Pending' ?></div>
          <small>Admission Status</small>
        </div>
        <i class="fas fa-user-check status-icon"></i>
        <div class="status-footer">
          <span class="text-white">
            <i class="fas fa-info-circle"></i> View details
          </span>
        </div>
      </div>
    </div>

    <!-- Download Section -->
    <div class="col-lg-3 col-md-6 col-12">
      <div class="status-container status-download">
        <div class="status-header">
          <div class="status-value">Documents</div>
          <small>Download Center</small>
        </div>
        <i class="fas fa-file-download status-icon"></i>
        <div class="status-footer">
          <?php if ($admiss !== 'Pending'): ?>
            <?= Html::a(
                '<i class="fas fa-download"></i> Download Letter', 
                ['/site/download'], 
                [
                    'class' => 'text-white',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Download admission documents'
                ]
            ) ?>
          <?php else: ?>
            <span class="text-white">
              <i class="fas fa-clock"></i> Pending approval
            </span>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
// Initialize tooltips
$this->registerJs('
    $(function () {
        $(\'[data-toggle="tooltip"]\').tooltip();
    });
');
?>