<x-nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="quiz-wrapper">
					<h1>

						<form action="/quiz/store" method="post" class="bg-gray-500 p-10 rounded-md ">
							<?php
foreach ($questions as $question) {
							?>

							<h2 class="text-white"><?=$question['question']?></h2>
							<input type="text" name="answer" id="answer" autocomplete="answer" placeholder="put your answer here"
								class="rounded-md pl-4 mb-4">

		


							<input type="hidden" name="realanswer" id="realanswer" value="$question->answer?>">


							<?php

}
?>
								<br>
						<button type="submit" class="bg-blue-800  rounded-md p-2">submit</button>
						</form>

				</div>
			</div>
		</div>
	</div>

</x-nav>