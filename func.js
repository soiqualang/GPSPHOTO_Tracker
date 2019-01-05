function show_tbl(pre,n,select_n){
	for(i=1;i<=n;i++){
		var tbl= document.getElementById(pre+i);
		tbl.style.display="none";
        if(i==select_n){
			tbl.style.display="block";
		}
	}
}
