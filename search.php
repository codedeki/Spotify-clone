<?php 
include("includes/includedFiles.php");

if (isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
}
else {
    $term = "";
}

?>

<div class="searchContainer">

    <h4>Search for an artist, album or song</h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="var val=this.value; this.value=''; this.value= val;" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

</div>

<script>

$(".searchInput").focus();

    $(function() {
        //remove var timer from here and put in script.js
        $(".searchInput").keyup(function() {
            clearTimeout(timer);

            timer = setTimeout(function() {
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 750)
        })
    })
</script>
<!-- Don't show anything if empty search -->
<?php if($term == "") exit(); ?>

<div class="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">
        
        <?php 
        $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");

        if (mysqli_num_rows($songsQuery) == 0) {
            echo "<span>No songs found matching " . $term . "</span>";
        }

        $songIdArray = array();
        $i = 1;
        while($row = mysqli_fetch_array($songsQuery)) {
            //limit number of showed songs to 15
            if ($i > 15) {
                break;
            }

            array_push($songIdArray, $row['id']);
            
            $albumSong = new Song($con, $row['id']);
            $albumArtist = $albumSong->getArtist();
            
            echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img class=''play src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span>
                        <span class='artistName'>" . $albumArtist->getName() . "</span>
                    </div>

                    <div class='trackOptions'>
                        <img class='optionsButton' src='assets/images/icons/more.png'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'>" . $albumSong->getDuration() . "</span>
                    </div>
                    
                </li>";
            $i++;

        }
      
        ?>
        <!-- playing (and looping) songs on search page by clicking on play button(s) beside song title-->
        <script>
            var tempSongsIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongsIds);
            console.log(tempPlaylist);
        </script>


    </ul>
</div>

<div class="artistsContainer borderBottom">
    <h2>ARTISTS</h2>

    <?php 
    $artistsQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");
    
    if (mysqli_num_rows($artistsQuery) == 0) {
        echo "<span>No artists found matching " . $term . "</span>";
    }

    while ($row = mysqli_fetch_array($artistsQuery)) {
        $artistsFound = new Artist($con, $row['id']);

        echo "<div class='searchResultRow'>
                <div class='artistName'>
                    <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistsFound->getId(). "\")'>
                    " . $artistsFound->getName() . "
                    </span>
                </div>
            </div>";
    }
    
    ?>
</div>

<div class="gridViewContainer">
    <h2>ALBUMS</h2>
    <?php 
        $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");

        if (mysqli_num_rows($albumQuery) == 0) {
            echo "<span>No albums found matching " . $term . "</span>";
        }

        while ($row = mysqli_fetch_array($albumQuery) ) {
        
            echo "<div class='gridViewItem'>
                    <span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
                    <img src='" . $row['artworkPath'] . "'>
                    <div class='gridViewInfo'>"
                        . $row['title'] .  
                    "</div> 
                </span>

                </div>";
        }
    ?>
</div>