<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Class | Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body {
            background: var(--bg-dark);
            margin: 0;
            display: flex;
            min-height: 100vh;
            color: white;
            font-family: 'Inter', sans-serif;
        }

        .tp-main {
            flex: 1;
            padding: 40px 60px;
            overflow-y: auto;
        }

        .tp-header {
            margin-bottom: 40px;
        }
        .tp-header h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            color: white;
        }
        .tp-header p {
            color: #aaa;
            margin: 5px 0 0 0;
            font-size: 15px;
        }

        .form-container {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 40px;
            max-width: 700px;
        }

        .form-group {
            margin-bottom: 24px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            color: #888;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 14px 16px;
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            color: white;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s;
            box-sizing: border-box;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(138,43,226,0.15);
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        .form-row .form-group {
            flex: 1;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(138,43,226,0.4);
        }
        .btn-cancel {
            background: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            display: inline-block;
            margin-left: 10px;
            transition: all 0.2s;
        }
        .btn-cancel:hover {
            background: rgba(255,255,255,0.2);
        }
    </style>
</head>
<body>

    <?= $this->element('trainer_nav') ?>

    <main class="tp-main">
        <div class="tp-header">
            <h1>Edit Class</h1>
            <p>Update class details.</p>
        </div>

        <div class="form-container">
            <?= $this->Form->create($gymClass) ?>
            
            <div class="form-group">
                <label>Class Name</label>
                <?= $this->Form->control('ClassName', ['label' => false, 'class' => 'form-control', 'required' => true]) ?>
            </div>

            <div class="form-group">
                <label>Trainer</label>
                <?= $this->Form->control('TrainerUserID', ['label' => false, 'class' => 'form-control', 'options' => $trainers, 'required' => true]) ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="datetime-local" name="StartTime" class="form-control" value="<?= $gymClass->StartTime ? $gymClass->StartTime->format('Y-m-d\TH:i') : '' ?>" required>
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input type="datetime-local" name="EndTime" class="form-control" value="<?= $gymClass->EndTime ? $gymClass->EndTime->format('Y-m-d\TH:i') : '' ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Capacity</label>
                <?= $this->Form->control('Capacity', ['label' => false, 'class' => 'form-control', 'type' => 'number', 'min' => 1, 'required' => true]) ?>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn-submit">Update Class</button>
                <a href="<?= $this->Url->build('/trainer/classes') ?>" class="btn-cancel">Cancel</a>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </main>

</body>
</html>
