
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{ asset('frontend_asset') }}/js/jquery.min.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/popper.min.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/bootstrap.min.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/ion.rangeSlider.min.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/slick.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/slider-bg.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/lightbox.js"></script> 
		<script src="{{ asset('frontend_asset') }}/js/smoothproducts.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/snackbar.min.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/jQuery.style.switcher.js"></script>
		<script src="{{ asset('frontend_asset') }}/js/custom.js"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->	

		<script>
			function openWishlist() {
				document.getElementById("Wishlist").style.display = "block";
			}
			function closeWishlist() {
				document.getElementById("Wishlist").style.display = "none";
			}
		</script>
		
		<script>
			function openCart() {
				document.getElementById("Cart").style.display = "block";
			}
			function closeCart() {
				document.getElementById("Cart").style.display = "none";
			}
		</script>

		<script>
			function openSearch() {
				document.getElementById("Search").style.display = "block";
			}
			function closeSearch() {
				document.getElementById("Search").style.display = "none";
			}
		</script>		

	</body>

</html>