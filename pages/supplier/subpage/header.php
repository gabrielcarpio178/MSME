<style>
    .nav-header{
        color: white;
        height: 75px;
    }
    .nav-header>h5{
        text-align: end;
    }
</style>
<header class="nav-header w-100 position-fixed py-4 px-2 bg-dark" style="z-index: 999;">
    <h5 class="text-capitalize">Welcome, <?php echo $_SESSION['name']['bussiness_name'] ?></h5>
</header>
