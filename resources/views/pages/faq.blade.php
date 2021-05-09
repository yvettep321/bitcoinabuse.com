{{------------------------------------------}}
{{--              PAGE CONFIG             --}}
{{------------------------------------------}}

@extends('layouts.default')

@section('seo-meta')
<title>Frequently Asked Questions | BitcoinAbuse.com </title>
@stop

{{------------------------------------------}}
{{--                CONTENT               --}}
{{------------------------------------------}}

@section('content')

<main role="main">
	<div class="jumbotron">
		<div class="container text-center">
			<h1 class="display-4">Frequently Asked Questions</h1>
		</div>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-md-10 offset-md-1">

				<h4 class="mt-5">What is BitcoinAbuse.com?</h4>
				<p>
					BitcoinAbuse.com is a public database of bitcoin addresses used by scammers, hackers, and criminals.
				</p>
				<p>
					Bitcoin is anonymous if used <u>perfectly</u>. Luckily, no one is perfect. Even hackers make mistakes. It only takes one slip to link stolen bitcoin to a hacker's real identity.
					It is our hope that by making a public database of bitcoin addresses used by criminals it will be harder for criminals to convert the digital currency back into fiat money.
				</p>

				<h4 class="mt-5">Someone is blackmailing me. Do they really have pictures of me? They have my old password.</h4>
				<p>
					<b class="text-danger">DO NOT PAY A RANSOM! DO NOT REPLY.</b>
				</p>
				<p>
					Blackmail demanding payment in Bitcoin is common.
					Criminals send thousands of emails a day claiming to have pictures or video of you in a compromising situation.
					<i>If they really had pictures of you they would have shown you.</i>
				</p>
				<p>
					Scammers buy dumps of old passwords on the darknet.
					This is just a scare tactic.
					All they have is your old password.
				</p>
				<p>
					<a href="https://haveibeenpwned.com/" target=_blank rel="noopener">See if your password has been leaked on the darknet</a>.
				</p>
				<p>
					<b>What should I do?</b>
					If they  have your password, change it.
					Never use that password ever again.
					You should also use <a href="https://authy.com/what-is-2fa/" target=_blank rel="noopener">Two-Factor Authentication</a>.
				</p>
				<p>
					Sometimes the email will appear to be sent from your own email address.
					They will claim this as "proof" that they have hacked your computer and your email account.
					In fact, spoofing an email is trivial.
				</p>
				<p>
					Read more about <a href="https://krebsonsecurity.com/2018/07/sextortion-scam-uses-recipients-hacked-passwords/" target=_blank rel="noopener">sextortion scams</a>.
				</p>

				<h4 class="mt-5">Where else can I report blackmail?</h4>
				<p>
					You can report Internet crimes to the FBI at <a href="https://www.ic3.gov/default.aspx" target=_blank rel=noopener>https://www.ic3.gov/default.aspx</a>.

					You can also report incidents to your local Law Enforcement.
				</p>



				<h4 class="mt-5">Is there an API?</h4>
				<p>
					Yup. Use the link below to view all distinct addresses that have been reported.
					The API will always be free but we may add authentication in the future.
					If you use our API in your project please link back to us.
				</p>
				<p>
					<code>https://www.bitcoinabuse.com/api/reports/distinct</code>
				</p>
				<p>
					If you want to report addresses automatically check out the <a href="/api-docs">full API Documentation</a>.
				</p>


				<h4 class="mt-5" id="remove">Can you remove a report?</h4>
				<p>No, in order to protect the integrity of the BitcoinAbuse database we will not remove or edit any reports.</p>


				<h4 class="mt-5">What are you doing to shutdown the bitcoin address I report?</h4>

				<p>
					There is nothing we can do.
					No bank or government has the technical ability to freeze an account to seize funds on the blockchain.
					That is why criminals use bitcoin.
				</p>
				<p>
					Our goal is to publicly documenting that certain addresses have been used in a crime.
					We hope that in the future it will be harder for the attacker to spend stolen bitcoin.
					At the very least, attackers will have to spend more on laundering the money.
				</p>

				<h4 class="mt-5">So why should I file a report at all?</h4>
				<p>
					One great reason to file a report about a certain address is it will help others see they are not alone.
					Many people are getting the exact same spam emails and they are all phony,
					hopefully by sharing this information fewer people will fall for these scams.
				</p>
				<p>
					But reporting also helps fight back against spam and extortion in a more direct way: by marking the addresses,
					and the coins associated with them, as illegitimate gains in a public record for all times. Someone might,
					for instance, Google the bitcoin address of a person seeking to spend the bitcoins, see it listed here,
					and refuse to do business with a thief. Or a large service that accepts bitcoin might check this database
					automatically, flagging transactions from these addresses as fraudulent.
				</p>
				<p>
					Criminals could, of course, get around these simpler measures by transferring the money to another address
					(which would cost them a transaction fee), or by mixing their coins in a laundering service (which would cost
					them a substantially higher fee). That would cost their time and money, and may still not be enough as coin-tracing
					algorithms improve. One thing is for certain: here, their misdeeds will be recorded forever for anyone who cares to
					know who they're doing business with, helping discourage future fraud and extortion.
				</p>

				<h4 class="mt-5">What else can I do?</h4>

				<p>
					If you want to invest stolen coins, track addresses, or attempt recovery or stolen funds, conciser purchasing a <a href="https://www.trace.bitcoinabuse.com" target=_blank>Bitcoin Risk Report</a>.
				</p>
				<p>
					Bitcoin Risk Reports provide Bitcoin Address Attribution Information, IP History Report, Risk Scores, and more.
					These reports are generated by <a href="/" target=_blank>BitcoinAbuse.com</a> in collaboration with <a href="https://ciphertrace.com" target=_blank>CipherTrace.com</a>, a leader in blockchain intelligence.
				</p>
				<p>
					Advanced blockchain analysis techniques are applied to distill valuable information which is then packaged into a PDF report.
					These reports can be used by investigators, law enforcement, and victims of bitcoin scams.
				</p>

				<hr class="my-4">
				<p>Questions or comments? <a href="/contact" target=_blank>Contact us</a></p>
				<br>
			</div>
		</div>

	</div>
</main>


@stop
