import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import {PageProps, User} from '@/types';
import AnswerChoiceBox from "@/Components/QuizComponents/AnswerChoiceBox";
import {useState} from "react";
import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/react/20/solid";

type ProblemObj = {
    question: string,
    answer_choices: number[],
    correct_answer_id: number
}
type ProblemsProps = {
    auth: {
        user: User;
    },
    problems: ProblemObj[]

}


export default function Problems({ auth, problems }: ProblemsProps) {
    const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
    const [selectedAnswer, setSelectedAnswer] = useState<undefined | number>(undefined);
    const [isSubmitted,setIsSubmitted] = useState(false);
    const currentProblem = problems[currentQuestionIndex];
    const [selectedAnswersArr, setSelectedAnswersArr] = useState<(number | undefined) []>([]);

    function handleBackClick(){
        setCurrentQuestionIndex((prevValue) => prevValue - 1);
    }

    function handleNextClick(){
        if(selectedAnswer ! == undefined){
        setSelectedAnswersArr((prevState) => [...prevState,selectedAnswer]);
        }
        setCurrentQuestionIndex((prevValue) => prevValue + 1);
        setSelectedAnswer(undefined);
    }
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Problems</h2>}
        >
            <Head title="Problems" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div className={'mt-8'}>
                                    <h3 className={'text-center'}>{currentProblem.question}</h3>
                                    <div className={'grid grid-cols-2 justify-items-center mt-8 gap-6 px-6'}>
                                    {currentProblem.answer_choices.map(el =>
                                        <AnswerChoiceBox selectedAnswer={selectedAnswer} setSelectedAnswer={setSelectedAnswer}>
                                            {el}
                                        </AnswerChoiceBox>)
                                    }
                                        <div className={'flex col-span-2 mx-auto gap-12 py-8'}>
                                            <button disabled={currentQuestionIndex === 0} onClick={handleBackClick}
                                                    className={'disabled:text-gray-400 text-blue-500 '}>
                                                <ChevronLeftIcon className={`size-12 disabled:text-gray-400`}/>
                                            </button>
                                            <button disabled={currentQuestionIndex !== 9 || selectedAnswer === undefined} className={'disabled:text-gray-400'}
                                            onClick={() => setIsSubmitted(true)}>
                                                Submit
                                            </button>
                                            <button disabled={currentQuestionIndex === 9 || selectedAnswer === undefined} onClick={handleNextClick}
                                            className={'disabled:text-gray-400 text-blue-500'}>
                                                <ChevronRightIcon className="size-12"/>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
