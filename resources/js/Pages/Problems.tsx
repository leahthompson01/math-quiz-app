import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, useForm} from '@inertiajs/react';
import {PageProps, User} from '@/types';
import AnswerChoiceBox from "@/Components/QuizComponents/AnswerChoiceBox";
import {useEffect, useState} from "react";
import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/react/20/solid";
import {Link} from "@inertiajs/react";
import axios from "axios";

type ProblemObj = {
    question: string,
    answer_choices: number[],
    correct_answer_id: number
}
type ProblemsProps = {
    auth: {
        user: User;
    },
    problems: ProblemObj[],
    id: number,


}
export type selectedAnswersObj = Record<number,number>;


export default function Problems({ auth, problems, id }: ProblemsProps) {
    const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
    const [selectedAnswer, setSelectedAnswer] = useState<undefined | number>(undefined);
    const [isSubmitted,setIsSubmitted] = useState(false);
    const currentProblem = problems[currentQuestionIndex];
    const [selectedAnswersArr, setSelectedAnswersArr] = useState<selectedAnswersObj[]>([]);

    function handleBackClick(){
        setCurrentQuestionIndex((prevValue) => prevValue - 1);
    }

    function handleNextClick(){
        // if(selectedAnswer !== undefined) {
        //     setSelectedAnswersArr((prevState) => [...prevState, selectedAnswer]);
        // }
        setCurrentQuestionIndex((prevValue) => prevValue + 1);
        // setSelectedAnswer(undefined)
    }

    const {post} = useForm({
        id: id,
    });

    async function handleSubmit(e) {
        e.preventDefault();
        setIsSubmitted(true);
        post("/quiz")

    }


    console.log('this is what the id is ', id);
    useEffect(() => {
        console.log('selectedAnswer',selectedAnswer)
        console.log('selected Answers ',selectedAnswersArr)
    }, [selectedAnswersArr, selectedAnswer])

    // useEffect(() => {
    //     console.log('selectedAnswer',selectedAnswer)
    //     console.log('selected Answers ',selectedAnswersArr)
    // }, [selectedAnswersArr, selectedAnswer])
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-white leading-tight">Problems</h2>}
        >
            <Head title="Problems" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className={'mt-8'}>
                            <form onSubmit={handleSubmit}>
                                <h3 className={'text-center text-gray-700 dark:text-white'}>{currentProblem.question}</h3>
                                <div className={'grid grid-cols-2 justify-items-center mt-8 gap-6 px-6'}>
                                    {currentProblem.answer_choices.map(el =>
                                        <AnswerChoiceBox selectedAnswer={selectedAnswer}
                                                         setSelectedAnswer={setSelectedAnswer}
                                                         key={el}
                                                         setSelectedAnswersArr={setSelectedAnswersArr}
                                                         currentQuestionIndex = {currentQuestionIndex}
                                            >
                                            {el}
                                        </AnswerChoiceBox>)
                                    }
                                    <div className={'flex col-span-2 mx-auto gap-12 py-8'}>
                                        <button disabled={currentQuestionIndex === 0} onClick={handleBackClick}
                                                className={'disabled:text-gray-400 text-blue-500 '}
                                                type={"button"}
                                        >

                                            <ChevronLeftIcon className={`size-12 disabled:text-gray-400`}/>
                                        </button>

                                        <button
                                            disabled={selectedAnswersArr.length !== 10 || isSubmitted}
                                            type={"submit"}
                                            className={'disabled:text-gray-400 text-gray-700 dark:text-white'}>
                                            Submit
                                        </button>
                                        <button
                                            disabled={currentQuestionIndex === 9 || selectedAnswer === undefined }
                                            onClick={handleNextClick}
                                            type={"button"}
                                            className={'disabled:text-gray-600 text-blue-500'}>
                                            <ChevronRightIcon className="size-12"/>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</AuthenticatedLayout>
)
    ;
}
