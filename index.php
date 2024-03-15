<?php
    $json_data = file_get_contents("emoji.json");
    $emojis = json_decode($json_data, true);
    $data = array_keys($emojis);
    $per_page = 256; 

    if (isset($_GET["page"])) {
        $n_page = $_GET["page"];
    }
    else {
        $n_page = 1;
    }
    echo $n_page;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>

        </nav>
    </header>
    <main>
        <section class="emoji_land">
            <div class="emoji_grid">
                <?php
                $crop_data = array();
                for ($i=($n_page-1)*$per_page+1; $i <= (($n_page * $per_page) < count($data) ? ($n_page * $per_page) : count($data)); $i++) {
                    array_push($crop_data, $data[$i]);
                }
                foreach ($crop_data as $emoji) { ?>
                    <div class="emoji_div">
                        <?php 
                            echo  $emoji;
                        ?>
                    </div>
                <?php } ?>
            </div>
            <nav class="paging">
                <a class="btn" href="index.php?page=<?php if ($n_page != 1) {echo $n_page-1;}else {echo $n_page;}?>"><</a>
                <?php
                    for ($i=1; ($i*$per_page) < count($data)+$per_page; $i++) { ?>
                        <a id="<?php echo "page_" . $i; ?>" class="btn" href="index.php?page=<?php echo $i?>"><?php echo $i;?></a>
                <?php } ?>
                <a class="btn" href="index.php?page=<?php if ($n_page < (count($data)/$per_page)-1) {echo $n_page+1;}else {echo $i;}?>">></a>
            </nav>
        </section>
    </main>
</body>
</html>