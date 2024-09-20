import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import {PageProps, User} from '@/types';

type ProblemObj = {
    question: string,
    answerChoices: number[],
    correct_answer_id: number
}
type ProblemsProps = {
    auth: {
        user: User;
    },
    problems: ProblemObj[]

}
export default function Problems({ auth, problems }: ProblemsProps) {
    console.log(problems)
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Problems</h2>}
        >
            <Head title="Problems" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">Problems Page</div>
                        { problems.map(obj => {
                            return (
                                <div>
                                    {obj.question}

                            </div>
                            )
                        })}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
