<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center"><?php echo $page_title; ?></h1>
            <hr>
            <?php foreach ($started_games as $game) { ?>
            <?php if ($game['your_choice_made']) { continue; } ?>
            <div class="started_game_parent">
                <form class="game_choice_parent" action="<?=base_url()?>game/bid/<?php echo $game['id']; ?>" method="post">
                    <input class="game_id" name="game_id" type="hidden" value="<?php echo $game['id']; ?>">
                    <table class="table">
                        <?php $payoff_i = 0; ?>
                        <thead>
                        </thead>
                        <tbody>
                            <?php if ($game['primary_user_key'] === $user['id']) { 
                                $this_player_type = 'primary';
                                $other_player_type = 'secondary';
                            } else {
                                $this_player_type = 'secondary';
                                $other_player_type = 'primary';
                            } ?>
                            <tr>
                                <td></td>
                                <td>
                                    <strong>You</strong>
                                </td>
                                <td>
                                    <strong><?php echo $game['other_player']['username']; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="choice_pre_label">Both Players</strong>
                                    <button class="game_choice_button btn btn-default" value="0" type="button">Do Nothing</button></td>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][0][$this_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][0][$other_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="choice_pre_label">Only You</strong>
                                    <button class="game_choice_button btn btn-default" value="0" type="button">Do Nothing</button></td>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][1][$this_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][1][$other_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="choice_pre_label">Both Players</strong>
                                    <button class="game_choice_button btn btn-default" value="1" type="button">Take Action</button></td>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][2][$this_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][2][$other_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="choice_pre_label">Only You</strong>
                                    <button class="game_choice_button btn btn-default" value="1" type="button">Take Action</button></td>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][3][$this_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                <td>
                                    <?php $this_payoff = $game['payoffs'][3][$other_player_type . '_payoff']; ?>
                                    <span class="h4 payoff_value <?php echo $this_payoff < 0 ? 'text-danger' : 'text-success'; ?>">
                                        <?php echo $this_payoff > 0 ? '+' . $this_payoff : $this_payoff; ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                <div class="other_player_info_parent">
                    <p>You are playing with <strong><?php echo $game['other_player']['username']; ?></strong></p>
                    <p>Joined on <span class="text-info"><?php echo date('F dS Y', strtotime($game['other_player']['created'])); ?></span></p>
                    <p>Has played <span class="text-primary"><?php echo $game['other_player']['games_played']; ?></span> games</p>
                    <p>Karma: 
                        <span class="text-success"><?php echo $game['other_player']['good_karma']; ?></span>
                        /
                        <span class="text-danger"><?php echo $game['other_player']['bad_karma']; ?></span>
                    </p>
                    <p>Karma Available: 
                        <span class="text-success"><?php echo $game['other_player']['available_good_karma']; ?></span>
                        /
                        <span class="text-danger"><?php echo $game['other_player']['available_bad_karma']; ?></span>
                    </p>
                    <?php if ( ($game['your_player_type'] && $game['secondary_choice_made']) || (!$game['your_player_type'] && $game['primary_choice_made']) ) { ?>
                    <p>They have made their move and is waiting on you</p>
                    <?php } ?>
                </div>

            </div>
            <?php } ?>
        </div>
    </div>
</div>