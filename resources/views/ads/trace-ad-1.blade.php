<div class="card w-100 mb-2" style="background: rgb(242,246,255); background: linear-gradient(0deg, rgba(242,246,255,1) 26%, rgba(234,238,253,1) 100%);">
	<div class="card-body">
		<h3 class="text-center mb-3">Bitcoin Risk Report</h3>
		<div class="d-flex">
			<ul class="list-unstyled justify-content-center mx-auto">
				<li><i class="fas fa-check-circle text-success"></i> Proprietary Risk Score</li>
				<li><i class="fas fa-check-circle text-success"></i> Detailed Attribution Data</li>
				<li><i class="fas fa-check-circle text-success"></i> IP Address History</li>
				<li><i class="fas fa-check-circle text-success"></i> Transaction History</li>
			</ul>
		</div>
		<div class="text-center">
			<a href="https://trace.bitcoinabuse.com?address={{ isset($address) ? $address : "" }}" class="btn btn-primary stretched-link" target=_blank> <i class="fas fa-download"></i> Download Report</a>
		</div>
	</div>
</div>
<p class="small text-muted font-italic text-center"> Bitcoin Risk Reports are created by <a href="/" target=_blank>BitcoinAbuse.com</a> in partnership with <a href="https://www.ciphertrace.com" target=_blank>CipherTrace.com</a>, a leader in Blockchain Intelligence.</p>
