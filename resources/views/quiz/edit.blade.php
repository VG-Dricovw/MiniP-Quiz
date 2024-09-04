<x-nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="quiz-wrapper">
                    <form method="POST" action="/quiz/<?=$question['id']?>">
                        @csrf
                        @method('PUT')
                        <div class="bg-gray-700 text-white rounded-md p-2 pl-4 my-2">
                       
                            <label for="chapter">Chapter:</label><br>
                            <input type="text" id="chapter" name="chapter" class="mb-5 rounded-md p-2 text-black" placeholder="<?=$question['chapter']?>" value=""><br>

                            <label for="question">Question:</label><br>
                            <input type="text" id="question" name="question" class="mb-5 rounded-md p-2 text-black" placeholder="<?=$question['question']?>" value=""><br>

                            <label for="answer">Answer:</label><br>
                            <input type="text" id="answer" name="answer" class=" rounded-md p-2 text-black" placeholder="<?=$question['answer']?>" value=""><br>
                            
                            <div class="flex flex-row mt-5">
                            
                            <a href="/quiz/display/display"><button class="bg-red-500 rounded-md p-2 mr-5" type="button">Cancel</button></a>
                            <button class="bg-yellow-500 rounded-md p-2 mr-5" type="reset">Reset</button></a>
                            <button class="bg-green-500 rounded-md p-2 mr-5" type="submit">Edit</button></a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-nav>