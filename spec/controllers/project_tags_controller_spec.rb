require 'spec_helper'

describe ProjectTagsController do
  render_views

  describe 'get #index' do
    context 'without tags' do
      let!(:projects) { 2.times.map { create(:project) } }

      before { get :index }

      it { should respond_with(:success) }

      it 'should pick up items without tags' do
        collection = assigns(:projects)
        expect(collection).to have(2).items
        expect(collection).to include(projects[0])
        expect(collection).to include(projects[1])
      end
    end

    context 'with tags' do
      let!(:comedy) { create(:project, tag_list: 'comedy') }
      let!(:horror) { create(:project, tag_list: 'horror') }

      before { get :index, tag: 'comedy' }

      it { expect(assigns(:projects)).not_to include(horror) }
      it { expect(assigns(:projects)).to include(comedy) }
    end
  end
end
