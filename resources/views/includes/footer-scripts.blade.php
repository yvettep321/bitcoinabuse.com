<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script>
<script src="{{ mix('/js/app.js') }}"></script>

@yield('page-scripts')

@stack('scripts')

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-34567782-6"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments)};
	gtag('js', new Date());
	gtag('config', 'UA-424'+'42'+'002-6');
</script>
