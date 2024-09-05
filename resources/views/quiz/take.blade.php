<x-nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="quiz-wrapper">
                    <form method="POST" action="/quiz/grade" class="bg-gray-500 p-10 text-white rounded-md">
                        @csrf
                        <?php
                        foreach ($questions as $question) {
                            $label = $question['id'];
                        ?>
                            <h2><?= $question['question'] ?></h2>
                            <label for="<?= $label ?>">Answer:</label><br>
                            <input type="text" id="<?= $label ?>" name="<?= $label ?>" class="mb-5 rounded-md p-2 text-black"
                                placeholder="answer here" value="">

                        <?php
                        } ?><br>
                        <button type="submit" class="bg-blue-800  rounded-md p-2">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-nav>
