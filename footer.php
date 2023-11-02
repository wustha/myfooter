<?php
# @Author: Waris Agung Widodo <user>
# @Date:   2018-01-23T11:26:05+07:00
# @Email:  ido.alit@gmail.com
# @Filename: footer.php
# @Last modified by:   Erwan Setyo Budi (erwans818@gmail.com)
# @Last modified time: 2018-01-23T11:26:47+07:00
?>
<?php
    
    // Visit Year
    $visityear = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count WHERE YEAR(checkin_date) = YEAR(now())'); 
    $visityear = $visityear->fetch_row();
    // Visit Month
    $visitmonth = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count WHERE MONTHNAME(checkin_date) = MONTHNAME(now()) AND YEAR(checkin_date) = YEAR(now())'); 
    $visitmonth = $visitmonth->fetch_row();
    // Visitor Today
    $visitday = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count WHERE DATE(checkin_date) = CURDATE()');
    $visitday = $visitday->fetch_row();
    // Visit All
    $visittotal = $dbs->query('SELECT COUNT(visitor_id)FROM visitor_count');
    $visitotal = $visittotal->fetch_row();
?>

<footer class="py-4 bg-blue-dark text-grey-lighter">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-3">
              <?php
              if(isset($sysconf['logo_image']) && $sysconf['logo_image'] != '' && file_exists('images/default/'.$sysconf['logo_image'])){
                echo '<img class="h-16 mb-2" src="images/default/'.v($sysconf['logo_image']).'">';
                }
              elseif (file_exists(__DIR__ . '/../assets/images/logo.png')) {
                echo '<img class="h-12 w-12 mb-2" src="' . assets(v('images/logo.png')) . '">';
              } else {
                ?>
                  <svg
                          class="fill-current text-grey-lighter block h-12 w-12 mb-2"
                          version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                          viewBox="0 0 118.4 135" style="enable-background:new 0 0 118.4 135;"
                          xml:space="preserve">
                    <path d="M118.3,98.3l0-62.3l0-0.2c-0.1-1.6-1-3-2.3-3.9c-0.1,0-0.1-0.1-0.2-0.1L61.9,0.8c-1.7-1-3.9-1-5.4-0.1l-54,31.1
                    l-0.4,0.2C0.9,33,0.1,34.4,0,36c0,0.1,0,0.2,0,0.3l0,62.4l0,0.3c0.1,1.6,1,3,2.3,3.9c0.1,0.1,0.2,0.1,0.2,0.2l53.9,31.1l0.3,0.2
                    c0.8,0.4,1.6,0.6,2.4,0.6c0.8,0,1.5-0.2,2.2-0.5l53.9-31.1c0.3-0.1,0.6-0.3,0.9-0.5c1.2-0.9,2-2.3,2.1-3.7c0-0.1,0-0.3,0-0.4
                    C118.4,98.6,118.3,98.5,118.3,98.3z M114.4,98.8c0,0.3-0.2,0.7-0.5,0.9c-0.1,0.1-0.2,0.1-0.2,0.1l-20.6,11.9L59.2,92.1l-33.9,19.6
                    L4.6,99.7l0,0l0,0C4.2,99.5,4,99.2,4,98.8l0-62.5l0,0l0-0.1c0-0.4,0.2-0.7,0.5-0.9l20.8-12l33.9,19.6l33.9-19.6l20.6,11.9l0.1,0
                    c0.3,0.2,0.5,0.5,0.6,0.9l0,62.3L114.4,98.8L114.4,98.8z M95.3,68.6v39.4L23.1,66.4V26.9L95.3,68.6z"/>
                </svg>
              <?php } ?>
                <div class="mb-4"><?php echo $sysconf['library_name']; ?></div>
                <ul class="list-reset">
                    <li><a class="text-light" href="index.php?p=libinfo"><?= __('Information'); ?></a></li>
                    <li><a class="text-light" href="index.php?p=librarian"><?= __('Librarian'); ?></a></li>
                    <li><a class="text-light" href="index.php?p=saran_online"><?= __('Saran'); ?></a></li>
                    <li><a class="text-light" href="index.php?p=usul_online"><?= __('Usul Buku'); ?></a></li>
                    <li><a class="text-light" href="index.php?p=daftar_online"><?= __('Pendaftaran Anggota'); ?></a></li>
                    <li><a class="text-light" href="index.php?p=member"><?= __('Login Anggota'); ?></a></li>
                </ul>
            </div>
            <div class="col-md-5 pt-8 md:pt-0">
                <h4 class="mb-4"><?= __('About Us'); ?></h4>
                <p>
                    <?= $sysconf['template']['classic_footer_about_us']; ?>
                </p>
                <hr>
                <p><h5>Jumlah Pengunjung</h5></p>
                <p>Hari ini: <?php echo $visitday['0'];?> | Bulan ini: <?php echo $visitmonth['0'];?> | Tahun ini: <?php echo $visityear['0'];?></p>
                <p>Total kunjungan: <?php echo $visitotal['0'];?></p>

                


            </div>
            <div class="col-md-4 pt-8 md:pt-0">
                <h4 class="mb-4"><?= __('Search'); ?></h4>
                <div class="mb-2"><?= __('start it by typing one or more keywords for title, author or subject'); ?></div>
                <form action="index.php">
                    <input type="hidden" ref="csrf_token" value="<?= $_SESSION['csrf_token']??'' ?>">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']??'' ?>">
                    <div class="input-group mb-3">
                        <input name="keywords" type="text" class="form-control"
                               placeholder="<?= __('Enter keywords'); ?>"
                               aria-label="Enter keywords"
                               aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" value="search" name="search"
                                    id="button-addon2"><?= __('Find Collection'); ?>
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                <a target="_blank" title="Support Us" class="btn btn-outline-success mb-2"
                   href="https://www.facebook.com/profile.php?id=100094059674022"><i
                            class="fas fa-heart mr-2"></i><?= __('Usul Judul Buku'); ?></a>
                <a target="_blank" title="Contribute" class="btn btn-outline-light mb-2"
                   href="https://www.facebook.com/profile.php?id=100094059674022"><i
                            class="fab fa-github mr-2"></i><?= __('Saran'); ?></a>
            </div>
        </div>
        <hr>
        <div class="flex font-thin text-sm">
            <p class="flex-1">&copy; <?php echo date('Y'); ?> &mdash; Wusthapustaka SD Marsudirini Yogyakarta</p>
            <div class="flex-1 text-right text-grey"><?= __('modby'); ?><code><strong>maseko</strong></code></div>
        </div>
    </div>
</footer>

<?php if ($sysconf['chat_system']['enabled'] && $sysconf['chat_system']['opac']) : ?>
    <div id="show-pchat2" style="position: fixed; bottom: 16px; right: 16px" class="shadow rounded">
        <button title="Chat" class="btn btn-primary"><i class="fas fa-comments mr-2"></i><?= __('Chat'); ?></button>
    </div>
<?php endif; ?>

<?php
// Chat Engine
include LIB . "contents/chat.php"; ?>

<!-- // Load modal -->
<?php include "_modal_topic.php"; ?>
<?php include "_modal_advanced.php"; ?>
<?php include "_modal_social_media.php"; ?>

<!-- // Load highlight -->
<script src="<?= JWB; ?>highlight.js"></script>
<?php if(isset($engine) && $searchableInJsArray = $this->generateKeywords($engine->searchable_fields)) : ?>
<script>
  $('.card-body > *').highlight(<?= $searchableInJsArray ?>);
</script>
<?php endif; ?>

<!-- // load our vue app.js -->
<script src="<?php echo assets(v('js/app.js')); ?>"></script>
<script src="<?php echo assets(v('js/app_jquery.js')); ?>"></script>
<?php include __DIR__ . "./../assets/js/vegas.js.php"; ?>
<?php if ($sysconf['chat_system']['enabled'] && $sysconf['chat_system']['opac']) : ?>
    <script>
        $('#show-pchat').click(() => {
            $('.s-chat').hide()
            $('#show-pchat2').show()
        })
        $('#show-pchat2').click(() => {
            $('.s-chat').show(300, () => {
                $('#show-pchat2').hide()
            })
        })
    </script>
<?php endif; ?>
</body>
</html>


