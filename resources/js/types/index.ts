export interface Category {
    id: number;
    name: string;
    sort_order: number;
    is_active: boolean;
    contents?: Content[];
}

export interface Content {
    id: number;
    category_id: number;
    title: string;
    author?: string;
    description?: string;
    image_url: string;
    rating: number;
    is_favorite: boolean;
    created_at?: string;
    updated_at?: string;
}

export enum SortOption {
    ID_ASC = 'idAsc',
    TITLE_ASC = 'titleAsc',
    TITLE_DESC = 'titleDesc',
    RATING_DESC = 'ratingDesc',
    RATING_ASC = 'ratingAsc',
    AUTHOR_ASC = 'authorAsc',
    AUTHOR_DESC = 'authorDesc'
}
