<spark-contributor-badge inline-template>
    <div>
		<div class="card card-default">
		    <div class="card-header">
		        {{__('Contributor Badges')}}
		    </div>

		    <div class="card-body">
				<p>
					Are you a BitcoinAbuse Contributor and want to show your support? Showcase your BitcoinAbuse contributions by placing the official BitcoinAbuse contributor badge on your site today.
				</p>
				<p>
    				Thank you for contributing to BitcoinAbuse.com.
    			</p>

    			<hr>

    			<h3>Customize Badge:</h3>

				<div class="form-group">
					<label for="widthInput">Badge Width</label>
					<div class="input-group">
						<input type="number" class="form-control" id="widthInput" v-model="width_px" aria-describedby="widthHelp" aria-describedby="px-addon" placeholder="420" max=640 :disabled="use_100_width">
						<div class="input-group-append">
							<span class="input-group-text" id="px-addon">px</span>
						</div>
					</div>
					<small id="widthHelp" class="form-text text-muted">Minimum 160px, Maximum 640px</small>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="100-width-option" v-model="use_100_width">
				  <label class="form-check-label" for="100-width-option">
				    100% width (max 640px)
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="dark-option" v-model="use_dark">
				  <label class="form-check-label" for="dark-option">
					Use dark badge
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="border-option" v-model="border">
				  <label class="form-check-label" for="border-option">
					Border
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="rounded-option" v-model="rounded_corners">
				  <label class="form-check-label" for="rounded-option">
					Rounded corners
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="link-option" v-model="include_link">
				  <label class="form-check-label" for="link-option">
					Include link to BitcoinAbuse
				  </label>
				</div>

				<hr>

    			<h3>Your Badge:</h3>

    			<div v-html="getCode()"></div>

    			<h3>Code:</h3>
    			<textarea class="form-control" readonly v-model="getCode()" rows=4 onclick="this.focus();this.select()"></textarea>
		    </div>
    </div>
</spark-contributor-badge>
