<x-nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="quiz-wrapper">
                    <h1>
                        <?php
foreach ($questions as $question) {
							?>

                        <div class="bg-gray-700 text-white rounded-md p-2 my-2">
                            <h2>Chapter: <?=$question['chapter']?></h2>
                            <h2>Question: <?=$question['question']?></h2>
                            <h2>Answer: <?=$question['answer']?></h2>

                            <div class="flex flex-row mt-5">
                                <a href="/quiz/<?=$question['id']?>/edit"><button
                                        class="bg-yellow-500 rounded-md p-2 mr-5">edit</button></a>

                                <form method="DELETE" href="/quiz/<?=$question['id']?>">
                                    @csrf
                                    <button class="bg-red-500 rounded-md p-2" type="submit">delete</button>
                                </form>
                            </div>
                        </div>
                        <?php
}
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>

</x-nav>