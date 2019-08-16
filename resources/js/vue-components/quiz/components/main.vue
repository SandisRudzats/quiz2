<template>
    <div>
        <quiz-start v-if="currentStep === 1"
                    :name="name"
                    :quizzes="quizzes"
                    @quiz-started="onQuizStarted">

        </quiz-start>

        <quiz-question :current-question="currentQuestion" v-else-if="currentStep === 2"
                       @results-received="onResultsReceived">

        </quiz-question>
        <quiz-result v-else-if="currentStep === 3"
                     @quiz-finished="onQuizFinished"
                     :current-quiz="currentQuiz"
                     :result="result">
            <ul>
                <li v-for=""></li>
            </ul>
        </quiz-result>

        <div v-else>
            <button @click="currentStep = 1">
                How did you get here? return back to the staart.
            </button>
        </div>
        {{ text }}
    </div>
</template>

<script>

    import QuizQuestionsComponent from './quiz-question.vue';
    import QuizResultsComponents from './quiz-result';
    import QuizStartComponent from './quiz-start.vue';
    import {Quiz} from './../models/quiz.models.js';

    export default {
        components: {
            'quiz-start': QuizStartComponent,
            'quiz-question': QuizQuestionsComponent,
            'quiz-result': QuizResultsComponents,


        },
        props: {

            name: {
                required: true,
            },
            quizzesProp: {
                default: [],
                required: true,
            }

        },
        created() {
            this.quizzes = this.quizzesProp.map((quizDatum) => {
                    return Quiz.fromArray(quizDatum);
                }
            );
        },
        data() {
            return {

                text: '',
                /** @type {Array<Quiz>} */
                quizzes: [],
                /** @type {Number} */
                currentStep: 1,
                /** @type {?Number}*/
                currentQuiz: null,
                /** @type {?Question}*/

                currentQuestion: null,

                result: null,

            }
        },
        methods: {
            /**
             *
             * @param emittedData {{quizId: number, firstQuestion: Question}} emittedData
             */
            onQuizStarted(emittedData) {
                let quizId = emittedData.quizId;
                this.currentQuiz = this.quizzes.find((quiz) => {
                        return quiz.id === quizId;
                    }
                );

                this.currentQuestion = emittedData.firstQuestion;
                this.currentStep++;
            },
            /**
             *
             * @param {{Result}} emittedResult
             */
            onResultsReceived(emittedResult) {
                this.result = emittedResult;
                this.currentStep++;
                this.currentQuestion = null;
            },
            onQuizFinished() {
                this.currentStep = 1;
                this.currentQuiz = 0;
                this.result = 0;

            }
        },

    }
</script>

<style scoped>

</style>