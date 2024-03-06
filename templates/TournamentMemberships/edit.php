<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TournamentMembership $tournamentMembership
 * @var string[]|\Cake\Collection\CollectionInterface $tournaments
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tournamentMembership->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tournamentMembership->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tournament Memberships'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tournamentMemberships form content">
            <?= $this->Form->create($tournamentMembership) ?>
            <fieldset>
                <legend><?= __('Edit Tournament Membership') ?></legend>
                <?php
                    echo $this->Form->control('tournament_id', ['options' => $tournaments]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('nick');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>