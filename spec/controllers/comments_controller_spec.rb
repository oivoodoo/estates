require 'spec_helper'

describe CommentsController do
	describe "#create" do
		let!(:p){ create(:project) }

		context 'with valid' do
			before { post :create, project_id: p.to_param, comment: { comment: "Hello!" } }

			it 'should create comment' do
				comment = assigns(:comment)
				expect(p.reload.comments).to have(1).item
	      expect(p.comments).to include(comment)
	      expect(comment.comment).to eq('Hello!')
			end
		end

		context 'with invalid' do
			before { post :create, project_id: p.to_param, comment: { comment: "" } }
			
		  it "should create empty comment" do
		    expect(p.reload.comments).to be_empty
		  end
		end
	end
end
