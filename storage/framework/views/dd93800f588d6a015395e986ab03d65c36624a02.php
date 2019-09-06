<input type="text" class="form-control" placeholder="Search" style="width: 300px;display: inline" id="search-bar" oninput="search()"></input>

<script>
	function search() {
		const table = document.getElementById("main-table");
		const searchBar = document.getElementById("search-bar");
		const toSearch = searchBar.value.toLowerCase();
		let visibleCount = table.rows.length - 1;
		let visible = false;

		for (let i = 0; i < table.rows.length; i++) {
			let includes = false;
			const cells = table.rows[i].cells;

			for (let j = 0; j < cells.length; j++) {
				const cellString = cells[j].innerHTML.toLowerCase();
				if (cellString.indexOf(toSearch) > -1 && !cells[j].hasAttribute('nosearch')) {
					includes = true;
					visible = true;
					break;
				}
			}

			table.rows[i].style.display = includes ? '' : 'none';
		}

		const noRecordDiv = document.getElementById('no-record');

		if (!visible && noRecordDiv) {
			noRecordDiv.style.display = '';
		}
	}
</script>
<?php /**PATH C:\xampp\htdocs\projs\LLS\resources\views/partials/search_bar.blade.php ENDPATH**/ ?>