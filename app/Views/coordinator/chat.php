</div>
<div class="container">
    <section class="card">
        <header class="card-header bg-white">
            <!-- <?php 
            //   $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            //   $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
            //   if(mysqli_num_rows($sql) > 0){
            //     $row = mysqli_fetch_assoc($sql);
            //   }else{
            //     header("location: users.php");
            //   }
            ?> -->
            <a href="#" class="back-icon"><i class="icon-sm" data-feather="arrow-left"></i></a>
            <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="avatar rounded-circle" alt="">
            <div class="details">
                <span>Art A. Antonio<!--< ?php echo $row['fname']. " " . $row['lname'] ?>--></span>
                <p>Offline now<!--< ?php echo $row['status']; ?>--></p>
            </div>
        </header>
        <div class="chat-box">
            <div class="chat outgoing">
                <div class="details">
                    <p>Hello Word</p>
                </div>
            </div>
            <div class="chat incoming">
                <img src="<?=base_url('public/uploads/assets/profiles')?>/default.png" class="rounded-circle" alt="">
                <div class="details">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore alias eos doloremque ea deserunt non itaque? Totam obcaecati atque distinctio!</p>
                </div>
            </div>
            <div class="chat outgoing">
                <div class="details">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque animi, aspernatur asperiores repellat sequi blanditiis.</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" hidden>
                <!-- <input type="text" class="incoming_id" name="incoming_id" value="< ?php echo $user_id; ?>" hidden> -->
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </div>
    </section>
</div>
<!-- <script src="<?=base_url('public/sources')?>/assets/js/chat.js"></script> -->
