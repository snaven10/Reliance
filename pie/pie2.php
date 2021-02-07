    </main>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vue/vue.js"></script>
    <script language='javascript'>
new Vue({
	el:'.menu',
	data:{
        Nivel: <?= $_SESSION['Nivel'] ?>,
	},
	methods:{
	}
});
</script>
</body>
</html>