<!--   Core JS Files   -->
<script src="<?= $dataProvider->get( 'lib-path' )?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="<?= $dataProvider->get( 'lib-path' )?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?= $dataProvider->get( 'asset-path' )?>js/bootstrap-checkbox-radio-switch.js"></script>

<!-- Navbar scripting -->
<script src="<?= $dataProvider->get( 'asset-path' )?>js/light-bootstrap-dashboard.js"></script>

<?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>