<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Trainers | Anytime Fitness</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <?= $this->Html->css(['anytime_home']) ?>
    <?= $this->Html->script('animations', ['defer' => true]) ?>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .btn-add {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(138,43,226,0.4);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.02);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.05);
            border-top: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);
        }
        .data-table th {
            text-align: left;
            padding: 16px 24px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            background: rgba(0,0,0,0.2);
            font-weight: 600;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .data-table td {
            padding: 16px 24px;
            font-size: 14px;
            color: #ddd;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            vertical-align: middle;
        }
        .data-table tr:hover td {
            background: rgba(255,255,255,0.02);
        }
        .data-table tr:last-child td { border-bottom: none; }

        .actions {
            display: flex;
            gap: 10px;
        }
        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }
        .btn-edit { background: rgba(52, 152, 219, 0.2); color: #3498db; }
        .btn-edit:hover { background: #3498db; color: white; }
        .btn-delete { background: rgba(231, 76, 60, 0.2); color: #e74c3c; }
        .btn-delete:hover { background: #e74c3c; color: white; }

        /* Flash Messages */
        .flash-msg {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            font-weight: 500;
        }
        .flash-success {
            background: rgba(46,204,113,0.1);
            border: 1px solid rgba(46,204,113,0.3);
            color: #2ecc71;
        }
    </style>
</head>
<body>

    <?= $this->element('trainer_nav') ?>

    <main class="tp-main">
        <div class="tp-header reveal">
            <div>
                <h1>Manage <span class="text-gradient">Trainers</span></h1>
                <p>Add, edit, or remove trainer accounts.</p>
            </div>
            <a href="<?= $this->Url->build('/trainer/add-trainer') ?>" class="btn-add reveal"><i class="ph ph-plus-circle"></i> Add Trainer</a>
        </div>

        <?php if ($this->Flash->render()): ?>
            <div class="flash-msg flash-success reveal">
                <i class="ph-fill ph-check-circle" style="font-size:20px;"></i>
                <div><?= $this->Flash->render() ?></div>
            </div>
        <?php endif; ?>

        <div class="reveal">
            <table class="data-table">
                <thead>
                    <tr>
                    <th>Trainer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Specialty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trainers as $t): ?>
                <tr>
                    <td style="font-weight: 600; color: white;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div style="width: 32px; height: 32px; border-radius: 50%; background: rgba(138,43,226,0.2); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                <?= strtoupper(substr($t->FullName, 0, 1)) ?>
                            </div>
                            <?= h($t->FullName) ?>
                        </div>
                    </td>
                    <td><?= h($t->Email) ?></td>
                    <td><?= h($t->Phone ?: 'N/A') ?></td>
                    <td><?= h($t->Username) ?></td>
                    <td>
                        <span style="background: rgba(46,204,113,0.15); color: #2ecc71; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                            <?= h($t->trainer->Specialty ?? 'General') ?>
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="<?= $this->Url->build('/trainer/edit-trainer/' . $t->UserID) ?>" class="btn-action btn-edit" title="Edit">
                                <i class="ph ph-pencil-simple"></i>
                            </a>
                            <?php if ($t->UserID !== $user->UserID): ?>
                                <?= $this->Form->postLink(
                                    '<i class="ph ph-trash"></i>',
                                    ['action' => 'deleteTrainer', $t->UserID],
                                    ['confirm' => 'Are you sure you want to delete this trainer?', 'class' => 'btn-action btn-delete', 'escape' => false, 'title' => 'Delete']
                                ) ?>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (count($trainers) === 0): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #666;">No trainers found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </main>

</body>
</html>
