import { useState, useEffect } from 'react';
import { getAllArticles } from '../services/ArticlesService'

export type Article = {
    id: number;
    title: string;
    content: string;
    createdAt: string;
    photos: {
        id: number;
        size: number;
        imageBlob: string;
    }[];
    user: string;
};

const useArticles = () => {
    const [articles, setArticles] = useState<Article[]>([]);
    const [loading, setLoading] = useState<boolean>(true);
    const [error, setError] = useState<Error | null>(null);

    useEffect(() => {
        const fetchArticles = async () => {
            try {
                const data = await getAllArticles();
                setArticles(data);
            } catch (err) {
                if (err instanceof Error) {
                    setError(err);
                } else {
                    // Si err n'est pas de type Error, créez une nouvelle instance d'Error
                    setError(new Error('An unknown error occurred'));
                }
            } finally {
                setLoading(false);
            }
        };

        fetchArticles();
    }, []);

    return { articles, loading, error };
};

export default useArticles;
