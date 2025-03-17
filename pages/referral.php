<section class="pb-5">
    <!-- Sub header -->
    <header class="sub-header">
        <h1 class="h3 text-center">
            <span style="font-size: 50px;">
                <?= number_format($user->getReferredCount($_COOKIE["uid"])) ?>
            </span>
            <br>
            <span style="font-size: 17px">
                Total Invite/s
            </span>
        </h1>

    </header>
    
    <div class="container">
    <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Date Registration</th>
                    <th>Name/Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $invited_list = $user->getInviteList($_COOKIE["uid"]);

                    function hideInfo($text) {
                        if (strlen($text) <= 2) {
                            return $text;
                        }
                        return $text[0] . str_repeat('*', strlen($text) - 2) . $text[strlen($text) - 1];
                    }

                    array_map(function($invite){
                        $info = $invite["name"] == "" ? hideInfo($invite["email"]) : hideInfo($invite["name"]);
                        $status = $invite["status"] == "1" ? "Upgraded account" : "free account";

                        echo "
                            <tr>
                                <td>". formatTimestamp($invite["registration_date"]) ."</td>
                                <td>". $info ."</td>
                                <td>". $status ."</td>
                            </tr>
                        ";
                    }, $invited_list);
                ?>
            </tbody>
        </table>
    </div>
    
</section>