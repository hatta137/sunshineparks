<section class="topbox">
    <div class="header-content">
        <?php
        require_once __DIR__.'/../../models/person.php';
            if(isset($_SESSION['person'])){
                $person = new Person($_SESSION['person']);
                $username = $person->FirstName;
            }else{
                $username = "UnknownUser";
            }
        ?>
        <h1>Hallo "<?=$username?>"</h1>

        <form>

            <a href=""><input type="button" value="Account bearbeiten"></a>
            <a href=""><input type="button" value="Meine Buchungen"></a>
            <a href=""><input type="button" value="Warenkorb"></a>
            <a href=""><input type="button" value="Nachrichten"></a>
            <a href=""><input type="button" value="Hilfe"></a>
            <a href="index.php?page=account&view=delete"><input type="button" value="Konto Löschen"></a>
            <a href="index.php?page=account&view=logout"><input type="button" value="Logout"></a>
        </form>
    </div>
</section>
